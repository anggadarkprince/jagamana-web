<section class="section">
    <div class="container">
        <header class="text-center visible-sm visible-xs mbsm">
            <h2 class="title-section mbxs">Freelance List</h2>
            <p class="description-section">Temukan pekerjaan yang cocok untuk membangun karirmu.</p>
        </header>
        <div class="calendar">
            <?=$this->calendar->generate($calendar["year"], $calendar["month"], $calendar["data"]);?>
            <p class="text-center mn mtsm">DAILY FREELANCE JOBS CALENDAR</p>
            <span class="text-center center-block text-muted">Accumulate jobs per day</span>
        </div>
    </div>
</section>

<?php $this->load->view("website/modals/info"); ?>