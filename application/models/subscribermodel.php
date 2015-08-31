<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/21/2015
 * Time: 9:50 PM
 */

class SubscriberModel extends CI_Model
{
    public static $table_name = "jm_subscriber";
    public static $primary_key = "sbr_id";
    public static $field_email = "sbr_email";

    public function __construct()
    {
        parent::__construct();
    }

    public function subscribe($email)
    {
        $result = $this->db->get_where(SubscriberModel::$table_name, array("sbr_email" => $email));
        if($result->num_rows() > 0){
            return true;
        }
        else{
            $result = $this->db->insert(SubscriberModel::$table_name, array("sbr_email" => $email));
            return $result;
        }
    }

    public function unsubscribe($email)
    {
        $result = $this->db->delete(SubscriberModel::$table_name, array(SubscriberModel::$field_email => $email));
        return $result;
    }

    public function send_newsletter()
    {
        $subscriber = $this->db->get(SubscriberModel::$table_name);
        $emails = $subscriber->result_array();

        $this->load->model("JobModel", "job_model");
        $data = $this->job_model->get_newsletter();

        $list = "";
        foreach($data as $row):
            $list .= '<tr>
                        <td style="border: 1px solid #ddd !important; padding: 15px;">
                            <h3 style="margin: 0 0 5px;"><a href="'.site_url()."job/detail/".permalink($row["vacancy"], $row["job_id"]).'.html" style="color: #4bb9fe; text-decoration: none;">'.$row["vacancy"].'</a></h3>
                            <p style="margin-bottom: 7px; margin-top: 0; line-height:20px">'.$row["description"].'</p>
                            <p style="margin-bottom: 5px; margin-top: 0; opacity: .7;"><small>'.$row["city"].', '.$row["country"].' | '.$row["level"].' | '.$row["field"].'</small></p>
                        </td>
                        <td style="border: 1px solid #ddd !important; padding: 8px; text-align: center;"><a href="'.site_url()."job/detail/".permalink($row["vacancy"], $row["job_id"]).'.html" style="padding: 10px 15px; border-radius: 5px; background: #4bb9fe; text-decoration: none; color: #ffffff; margin: 2px; display: inline-block; vertical-align: middle; font-weight: 600;">APPLY NOW</a></td>
                    </tr>';
        endforeach;

        $this->_send_batch_mail($emails, $list, "Jagamana Daily Newsletter at ".date("d F Y"));
    }

    public function send_update()
    {
        $query = "SELECT emp_id, emp_email, emp_name FROM jm_employee WHERE emp_status = 'ACTIVE' AND emp_notification = 1";
        $result = $this->db->query($query);
        $employees = $result->result_array();

        foreach($employees as $employee):
            $query = "
              SELECT * FROM jm_view_job
              WHERE company_id IN (
                SELECT flw_company
                FROM jm_employee
                INNER JOIN jm_follower
                  ON emp_id = flw_employee
                WHERE emp_status = 'ACTIVE'
                  AND emp_notification = 1
                  AND flw_employee = '$employee[emp_id]'
                )
              AND DATE(created_at) = CURDATE()
            ";
            $result = $this->db->query($query);
            $jobs = $result->result_array();

            if(count($jobs) > 0){
                $list = "";
                foreach($jobs as $row):
                    $list .= '<tr>
                        <td style="border: 1px solid #ddd !important; padding: 15px;">
                            <h3 style="margin: 0 0 5px;"><a href="'.site_url()."job/detail/".permalink($row["vacancy"], $row["job_id"]).'.html" style="color: #4bb9fe; text-decoration: none;">'.$row["vacancy"].'</a></h3>
                            <p style="margin-bottom: 7px; margin-top: 0; line-height:20px">'.$row["description"].'</p>
                            <p style="margin-bottom: 5px; margin-top: 0; opacity: .7;"><small>'.$row["city"].', '.$row["country"].' | '.$row["level"].' | '.$row["field"].'</small></p>
                        </td>
                        <td style="border: 1px solid #ddd !important; padding: 8px; text-align: center;"><a href="'.site_url()."job/detail/".permalink($row["vacancy"], $row["job_id"]).'.html" style="padding: 10px 15px; border-radius: 5px; background: #4bb9fe; text-decoration: none; color: #ffffff; margin: 2px; display: inline-block; vertical-align: middle; font-weight: 600;">APPLY NOW</a></td>
                    </tr>';
                endforeach;

                $this->_send_batch_mail($employee['emp_email'], $list, "Jobs Update at ".date("d F Y"), $employee['emp_name']);
            }
        endforeach;
    }

    private function _send_batch_mail($emails, $list, $title = null, $name = null)
    {
        $this->load->library('mailer');

        $mail               = new PHPMailer();
        $mail->SMTPAuth     = true;
        $mail->SMTPSecure   = "ssl";
        $mail->Host         = "smtp.gmail.com";
        $mail->Port         = 465;
        $mail->Username     = "jagamana.service@gmail.com";
        $mail->Password     = "jagamana1234";
        $mail->Subject      = $title;
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->SetFrom('no-reply@jagamana.com', 'Jagamana Service');
        $mail->AddReplyTo("no-reply@jagamana.com","Jagamana Service");

        if(is_array($emails)){
            foreach($emails as $email):
                $receiver = $email["sbr_email"];

                $template           = file_get_contents(base_url() . '/assets/template/newsletter.html');
                $template           = preg_replace('%EMAIL%', $receiver, $template);
                $template           = preg_replace('%NAME%', $receiver, $template);
                $template           = preg_replace('%UNSUBSCRIBE%', site_url()."page/unsubscribe/".urlencode($receiver), $template);
                $template           = preg_replace('%NEWSLETTER%', $list, $template);
                $template           = preg_replace('%YEAR%', date("Y"), $template);
                $template           = preg_replace('%ADDRESS%', get_setting("Address"), $template);
                $mail->Body         = $template;

                if($name != null){
                    $mail->AddAddress($receiver, $name);
                }
                else{
                    $mail->AddAddress($receiver, $receiver);
                }

                $mail->Send();
            endforeach;
        }
        else{
            $template           = file_get_contents(base_url() . '/assets/template/newsletter.html');
            $template           = preg_replace('%EMAIL%', $emails, $template);
            $template           = preg_replace('%NAME%', $name, $template);
            $template           = preg_replace('%UNSUBSCRIBE%', site_url()."dashboard/setting", $template);
            $template           = preg_replace('%NEWSLETTER%', $list, $template);
            $template           = preg_replace('%YEAR%', date("Y"), $template);
            $template           = preg_replace('%ADDRESS%', get_setting("Address"), $template);
            $mail->Body         = $template;

            $mail->AddAddress($emails, $name);

            $mail->Send();
        }

    }

}