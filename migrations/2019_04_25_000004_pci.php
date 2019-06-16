<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class PCI extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('pci', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->nullable();
            $table->string('name')->nullable();
            $table->string('sppci_device_type')->nullable();
            $table->string('sppci_driver_installed')->nullable();
            $table->string('sppci_link-speed')->nullable();
            $table->string('sppci_link-width')->nullable();
            $table->string('sppci_msi')->nullable();
            $table->string('sppci_pause-compatible')->nullable();
            $table->string('sppci_slot_name')->nullable();
            $table->string('sppci_revision-id')->nullable();
            $table->string('vendor')->nullable();
            $table->string('sppci_name')->nullable();
         
            $table->text('device_json')->nullable();
            
            $table->index('serial_number');
            $table->index('name');
            $table->index('vendor');
            $table->index('sppci_device_type');
            $table->index('sppci_link-speed');
            $table->index('sppci_link-width');

        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('pci');
    }
}
