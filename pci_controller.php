<?php 

/**
 * PCI module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Pci_controller extends Module_controller
{
	
	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 * @author avb
	 *
	 **/
	function index()
	{
		echo "You've loaded the pci module!";
	}

   /**
     * Get PCI device names for widget
     *
     * @return void
     * @author tuxudo
     **/
     public function get_pci_devices()
     {
         
        $sql = "SELECT COUNT(CASE WHEN name <> '' AND name IS NOT NULL THEN 1 END) AS count, name 
                FROM pci
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY name
                ORDER BY count DESC";
        
        $out = array();
        $queryobj = new Pci_model;
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->name = $obj->name ? $obj->name : 'Unknown';
                $out[] = $obj;
            }
        }

        jsonView($out);
     }
    
   /**
     * Retrieve data in json format
     *
     **/
    public function get_data($serial_number = '')
    {
    
        $sql = "SELECT name, device_type, driver_installed, link_speed, link_width, device_name, slot_name, 
                        device_id, revision_id, subsystem_id, subsystem_vendor_id, vendor_id
                        FROM pci 
                        WHERE serial_number = '$serial_number'";

        $queryobj = new Pci_model();
        jsonView($queryobj->query($sql));
    }
		
} // End class Pci_controller
