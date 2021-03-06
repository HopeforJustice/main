<?php

namespace Give\DonorDashboards\Admin;

class SuccessNotice
{

    /**
     * Reigster success notice
     *
     * @since 2.10.0
     * @return void
     *
     */
    public function register()
    {
        if ($this->shouldRenderOutput()) {
            $this->renderOutput();
        }
    }

    /**
     * Return true if notice should be rendered, false if not
     *
     * @since 2.10.0
     * @return boolean
     *
     */
    protected function shouldRenderOutput()
    {
        return isset($_GET['give-generated-donor-dashboard-page']);
    }

    /**
     * Render notice output
     *
     * @since 2.10.0
     * @return void
     *
     */
    protected function renderOutput()
    {
        echo $this->getOutput();
    }

    /**
     * Get notice output
     *
     * @since 2.10.0
     * @return string
     *
     */
    protected function getOutput()
    {
        ob_start();
        $output = '';
        require $this->getTemplatePath();
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    /**
     * Get template path for notice output
     *
     * @since 2.10.0
     * @return string
     *
     */
    protected function getTemplatePath()
    {
        return GIVE_PLUGIN_DIR . '/src/DonorDashboards/resources/views/successnotice.php';
    }
}
