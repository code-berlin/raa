<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {

	var $obj;
	var $layout;

	function Layout($layout = "default"){
		$this->obj =& get_instance();
		$this->layout = $layout;
	}

	function setLayout($layout){
		$this->layout = $layout;
	}

	function view($view, $data=null, $return=false){
    	$loadedData['template_content'] = $this->obj->load->view($view,$data,true);
        /* load seo information */

        $loadedData = $this->_load_seo_information($loadedData, $data['type'], $data['id']);

		if($return):
			$output = $this->obj->load->view('layouts/'.$this->layout, $loadedData, true);
			return $output;
		else:
			$this->obj->load->view('layouts/'.$this->layout, $loadedData, false);
		endif;
	}



     /*
     * function _load_seo_information($loadedData)
	 * @param	$loadedData	the data already initialised by the view function
         * @param       $type   the page / content type type - if no set, the current page is the homepage
         * @param       $id     the id of the page - if set to 0, the current page is the homepage
	 * @return	Array   the input data enriched with SEO information
         *
         * The function will retrieve SEO information from the current page / content type
         * In case of success, it will return them, otherwise it will try to retrieve those found in general settings (if set)
         * If not set, it will fill up the array with empty strings
         *
	 */
        function _load_seo_information($loadedData = array(), $type = 'page', $id = 0){

            $this->obj->load->model('settings_m');

            // by default take the generic settings
            $loadedData['seo_meta_title'] = $this->obj->settings_m->get_seo_meta_title();
            $loadedData['seo_meta_keywords'] = $this->obj->settings_m->get_seo_meta_keywords();
            $loadedData['seo_meta_description'] = $this->obj->settings_m->get_seo_meta_description();
            $loadedData['seo_footer_text'] = $this->obj->settings_m->get_seo_footer_text();

            if($type!=='' && $id !== 0){

                if(!$type) { $type = 'page'; }

                // load the object
                $this->obj->load->model($type.'_m');
                $object = $this->obj->{$type.'_m'}->get_by_id($id);

                // some or all specific settings are provided: take the specific settings
                if($this->_check_current_seo_settings($object) !== 0){

                        $loadedData['seo_meta_title'] = $object->seo_meta_title;
                        $loadedData['seo_meta_keywords'] = $object->seo_meta_keywords;
                        $loadedData['seo_meta_description'] = $object->seo_meta_description;
                        $loadedData['seo_footer_text'] = $object->seo_footer_text;
                }


            }

            return $loadedData;

        }

    /*
     * private _load_seo_information($loadedData)
     * @param   $object the current object
     * @return  int   0 : no specific setting - 1: some specific settings - 2: all specific settings
     *
     * The function will check the seo attribute of a generic object and will return an integer (see: above)
     *
     */
        function _check_current_seo_settings($object){

            if( ($object->seo_meta_title && trim($object->seo_meta_title)!=='')
                &&
                ($object->seo_meta_keywords && trim($object->seo_meta_keywords)!=='')
                &&
                ($object->seo_meta_description && trim($object->seo_meta_description)!=='')
                &&
                ($object->seo_footer_text && trim($object->seo_footer_text)!=='')
               )
            {
                return 2;
            }
            else
            if( (!$object->seo_meta_title || trim($object->seo_meta_title)=='')
                &&
                (!$object->seo_meta_keywords || trim($object->seo_meta_keywords)=='')
                &&
                (!$object->seo_meta_description || trim($object->seo_meta_description)=='')
                &&
                (!$object->seo_footer_text || trim($object->seo_footer_text)=='')
              )
            {
                return 0;
            }
            else return 1;
        }

}
?>