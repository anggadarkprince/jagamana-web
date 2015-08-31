<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="form-section">
                        <div class="title">
                            <h3><i class="fa fa-pencil-square"></i> Resume</h3>
                            <p>Create your curriculum vitae and portfolio</p>
                            <p>Writing a great resume does not necessarily mean you should follow the rules you hear through the grapevine. It does not have to be one page or follow a specific resume format. Every resume is a one-of-a-kind marketing communication. It should be appropriate to your situation and do exactly what you want it to do.</p>
                        </div>
                        <!-- alert -->
                        <?php
                        if($this->session->flashdata('jm-operation')!= NULL)
                        {
                            ?>
                            <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('jm-message'); ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- end of alert -->
                        <div class="title">
                            <?php
                            $current_file = "No file resume available, make the new one";
                            $empty = true;
                            if(isset($resume)){
                                if($resume["emp_resume"] != null){
                                    $current_file = $resume["emp_resume"];
                                    $empty = false;
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>1. Upload My Own Resume</h3>
                                    <p>Provide your own resume</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <form action="<?=site_url()?>resume/upload" method="post" enctype="multipart/form-data" id="jm-form-file-resume">
                                        <button class="btn btn-primary file"><i class="fa fa-upload"></i> UPLOAD RESUMES
                                            <input type="file" name="jm-resume-file" id="jm-resume-file">
                                        </button>
                                    <?php
                                    if(!$empty)
                                    {
                                        ?>
                                        <a href="<?=base_url()?>assets/data/<?=$current_file?>" download class="btn btn-primary"><i class="fa fa-download mn"></i></a>
                                        <?php
                                    }
                                    ?>
                                    </form>
                                </div>
                            </div>
                            <blockquote class="mbmd" style="background-color: #f4f8fa;  border-color: #bce8f1; padding: 10px 15px">
                                <p class="mn"><?=$current_file?></p>
                                <span class="text-primary">Current Resume File.</span>
                            </blockquote>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>2. Create Jagamana Resume</h3>
                                    <p>Jagamana Standard Resumes</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="<?=site_url()?>resume/standard.html" class="btn btn-primary"><i class="fa fa-file-text"></i> EDIT STANDARD RESUME</a>
                                    <a href="<?=site_url()?>resume/generate.html" download class="btn btn-primary"><i class="fa fa-print mn"></i></a>
                                </div>
                            </div>
                            <p class="text-justify">Resume Builder is the fastest, most efficient way to build an effective resume. We provide professional designs for general jobs and industries, Resume Builder also includes sample phrases written by our team, plus helpful tips and advice to make your resume stand out.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>