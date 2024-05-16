<?php
class ControllerCommonHome extends Controller {
    public function index() {
        $data = array();
        $session_id = session_id();
        $ip_data = isset($this->session->data['loader_displayed_time_' . $session_id]) ? $this->session->data['loader_displayed_time_' . $session_id] : false;
        if ($ip_data === false || (time() - $ip_data > 3600)) {
            $data['loader'] = $this->load->view('common/loader', $data);
            $this->session->data['loader_displayed_time_' . $session_id] = time();
            $data['loader_loaded'] = false;
        } else {
            $this->document->setTitle($this->config->get('config_meta_title'));
            $this->document->setDescription($this->config->get('config_meta_description'));
            $this->document->setKeywords($this->config->get('config_meta_keyword'));
            if (isset($this->request->get['route'])) {
                $this->document->addLink($this->config->get('config_url'), 'canonical');
            }
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['header'] = $this->load->controller('common/header');
            $data['footer'] = $this->load->controller('common/footer');
            $data['content'] = $this->load->view('common/home', $data);
            $data['loader_loaded'] = true;
        }
        $this->response->setOutput($this->load->view('common/home', $data));
    }
}





