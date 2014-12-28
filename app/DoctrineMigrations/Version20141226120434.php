<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141226120434 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module ADD max_budget INT DEFAULT NULL, ADD max_capacity_p INT DEFAULT NULL, ADD max_price_p INT DEFAULT NULL, ADD max_capacity_t INT DEFAULT NULL, ADD max_price_t INT DEFAULT NULL, DROP max_capacity, DROP max_price');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module ADD max_capacity INT DEFAULT NULL, ADD max_price INT DEFAULT NULL, DROP max_budget, DROP max_capacity_p, DROP max_price_p, DROP max_capacity_t, DROP max_price_t');
    }
}
