<?php

class ViewsController extends Controller {
    public function studentDashboard() {
    $this->view("dashboards/student");
}

    public function companyDashboard() {
        $this->view("dashboards/company");
    }

    public function login() {
        $this->view("auth/login");
    }

    public function register() {
        $this->view("auth/register");
    }
}