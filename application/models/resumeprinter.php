<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/9/2015
 * Time: 6:17 PM
 */

class ResumePrinter extends CI_Model{

    public function __construct()
    {
        $this->load->library("pdf");
    }

    public function generate_resume($employee = null)
    {
        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("EducationModel", "education_model");
        $this->load->model("ExperienceModel", "experience_model");
        $this->load->model("SkillModel", "skill_model");
        $this->load->model("PortfolioModel", "portfolio_model");

        if($employee != null)
        {
            $employee_id = $employee;
        }
        else{
            $employee_id = $this->session->userdata(UserModel::$SESSION_ID);
        }

        $profile = $this->employee_model->read($employee_id);
        $education = $this->education_model->read_by_employee($employee_id);
        $experience = $this->experience_model->read_by_employee($employee_id);
        $skill = $this->skill_model->read_by_employee($employee_id);
        $portfolio = $this->portfolio_model->read_by_employee($employee_id);

        $about = $profile["emp_about"];

        $profile = array(
            array("Name",$profile["emp_name"]),
            array("Day of Birthday",$profile["emp_birthday"]),
            array("Nationality",$profile["emp_nationality"]),
            array("Gender",$profile["emp_gender"]),
            array("Address",$profile["emp_address"]),
            array("Contact",$profile["emp_contact"]),
            array("Email",$profile["emp_email"]),
            array("Website",$profile["emp_website"]),
        );


        $this->pdf->init("P", "A4", 20, 20, "", "Jagamana.Inc");
        $this->pdf->SetAutoPageBreak(true, 30);
        $this->pdf->SetFont('Arial', 'B', 14);
        $this->pdf->Cell(70, 7, 'Jagamana Standard Resume', 0, 1, 'L');
        $this->pdf->SetTextColor(100, 100, 100);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->Cell(40, 5, "Generated at " . date('d/m/Y'), 0, 0);

        $this->pdf->SetX(-60);
        $this->pdf->Cell(40, 5, "Resume ID " . uniqid(), 0, 1);

        /* DATA PROFILE */
        $width = array(60, 110);
        $header = array('Key', 'Value');
        $header_align = array("L", "L");
        $data_align = array("L", "L");

        $this->pdf->set_table_size(9, 20, 10, false);
        $this->pdf->set_table_style(0.2, false, true, false);
        $this->pdf->set_table_border_color(230, 230, 230);

        $this->setCaption('PERSONAL DETAIL');
        $this->pdf->Ln(1);
        $this->pdf->create_table($header, $profile, $width, $header_align, $data_align);

        /* DATA PROFILE */
        $this->setCaption('PERSONAL PROFILE');
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->MultiCell(0, 7, $about, 0, 'J');

        /* DATA EDUCATION */
        $this->setCaption('EDUCATION');
        foreach($education as $row):
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(70, 6, $row["edc_education"], 0, 0, 'L');

            $this->pdf->SetX(-100);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(80, 6, $row["edc_year_begin"]." - ".$row["edc_year_until"], 0, 1, 'R');

            $this->pdf->SetTextColor(100, 100, 100);
            $this->pdf->Cell(70, 6, $row["edc_institution"], 0, 0, 'L');

            $this->pdf->SetX(-100);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(80, 6, $row["edc_location"], 0, 1, 'R');

            $this->pdf->Ln(1.5);
            $this->pdf->Cell(170, 0, "", "B", 1);
            $this->pdf->Ln(1.5);
        endforeach;

        /* DATA EXPERIENCE */
        $this->setCaption('EXPERIENCE');
        foreach($experience as $row):
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(70, 6, $row["exp_company"], 0, 0, 'L');

            $this->pdf->SetX(-100);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(80, 6, $row["exp_year_begin"]." - ".$row["exp_year_until"], 0, 1, 'R');

            $this->pdf->SetTextColor(100, 100, 100);
            $this->pdf->Cell(70, 6, $row["exp_description"], 0, 0, 'L');

            $this->pdf->SetX(-100);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(80, 6, $row["exp_position"], 0, 1, 'R');

            $this->pdf->Ln(1.5);
            $this->pdf->Cell(170, 0, "", "B", 1);
            $this->pdf->Ln(1.5);
        endforeach;

        /* DATA SKILL */
        $this->setCaption('SKILLS & ATTRIBUTES');
        $this->pdf->SetTextColor(0, 0, 0);

        foreach($skill as $row):

            $this->pdf->SetFont('Arial', 'B', 11);
            $this->pdf->Cell(60, 12, $row["category"], 0, 1, 'L');

            foreach($row["skill"] as $attribute):
                $this->pdf->SetFont('Arial', '', 10);
                $this->pdf->Cell(50, 6, $attribute["skl_skill"], 0, 0, 'L');

                $this->pdf->Cell(85, 6, $attribute["skl_description"], 0, 0, 'L');


                for($i = 0; $i < 5; $i++)
                {
                    $type = 0;
                    $img = base_url()."assets/img/layout/level-inactive.png";
                    if($i < $attribute["skl_value"]){
                        $img = base_url()."assets/img/layout/level-active.png";
                    }
                    if($i == 4){
                        $type = 1;
                    }
                    $this->pdf->Cell(6, 6, $this->pdf->Image($img, $this->pdf->GetX()+5,$this->pdf->GetY()+1.5,3), 0, $type, 'R');
                }


                $this->pdf->Ln(1.5);
                $this->pdf->Cell(170, 0, "", "B", 1);
                $this->pdf->Ln(1.5);
            endforeach;

        endforeach;


        /* DATA PORTFOLIO */
        $this->setCaption('PORTFOLIO');
        $this->pdf->SetTextColor(0, 0, 0);
        $counter = 0;
        foreach($portfolio as $row):
            $counter++;

            $img = base_url()."assets/img/portfolio/".$row["prt_screenshot"];

            $type = 0;
            if($counter % 3 == 0){
                $type = 1;
            }
            $this->pdf->Cell(57, 45, $this->pdf->Image($img, $this->pdf->GetX()+2.5,$this->pdf->GetY()+2.5, 52, 40), 1, $type, 'C');
        endforeach;


        $filename = "Resume - ".$this->session->userdata(UserModel::$SESSION_NAME).".pdf";
        $this->pdf->Output($filename, "I");

    }

    public function setCaption($string)
    {
        $this->pdf->Ln(7);
        $this->pdf->SetTextColor(68, 193, 229);
        $this->pdf->SetFont('Arial', '', 16);
        $this->pdf->Cell(70, 7, $string, 0, 1, 'L');
        $this->pdf->Ln(3);
    }
}