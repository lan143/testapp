<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invite_codes`.
 */
class m171220_165245_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%promo_codes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'client_reward' => $this->decimal(10, 2),
            'status' => $this->smallInteger(3)->unsigned()->defaultValue(0),
            'tariff_zone_id' => $this->integer(11)->unsigned(),
        ], $tableOptions);

        $this->createTable('{{%tariff_zones}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->insert('{{%tariff_zones}}', [
            'name' => 'Москва',
        ]);

        $this->insert('{{%tariff_zones}}', [
            'name' => 'Санкт-Петербург',
        ]);

        $this->insert('{{%tariff_zones}}', [
            'name' => 'Ростов-на-Дону',
        ]);

        $this->insert('{{%tariff_zones}}', [
            'name' => 'Краснодар',
        ]);

        $this->insert('{{%tariff_zones}}', [
            'name' => 'Волгоград',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%promo_codes}}');
        $this->dropTable('{{%tariff_zones}}');
    }
}
