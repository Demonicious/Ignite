<?php namespace Migrations;

class Install extends \Ignite\Database\Migration {
    public function update() {
        if(!$this->schema()->hasTable('theme_settings')) {
            $this->schema()->create('theme_settings', function($table) {
                $table->id();
                $table->timestamps();

                $table->string('domain', 255);
                $table->json('settings')->nullable();
            });
        }
    }

    public function rollback() {
        $this->schema()->dropIfExists('theme_settings');
    }
}