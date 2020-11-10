<?php namespace Migrations;

class Install extends \Ignite\Database\Migration {
    public function up() {
        if(!$this->schema()->hasTable('theme_settings')) {
            $this->schema()->create('theme_settings', function($table) {
                $table->id();
                $table->timestamps();

                $table->string('domain', 255);
                $table->json('settings')->nullable();
            });
        }

        if(!$this->schema()->hasTable('app_settings')) {
            $this->schema()->create('app_settings', function($table) {
                $table->id();
                $table->timestamps();

                $table->string('setting', 255);
                $table->text('value')->nullable();
            });
        }
    }

    public function down() {
        $this->schema()->dropIfExists('theme_settings');
        $this->schema()->dropIfExists('app_settings');
    }
}