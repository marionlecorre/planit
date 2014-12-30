<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141230110515 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE TypeGuest (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, `label` VARCHAR(30) NOT NULL, slug VARCHAR(30) NOT NULL, message TINYTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_65AD8281AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE TypeGuest ADD CONSTRAINT FK_65AD8281AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE guest ADD type_guest_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_6D76B53157B581A4 FOREIGN KEY (type_guest_id) REFERENCES TypeGuest (id)');
        $this->addSql('CREATE INDEX IDX_6D76B53157B581A4 ON guest (type_guest_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Guest DROP FOREIGN KEY FK_6D76B53157B581A4');
        $this->addSql('DROP TABLE TypeGuest');
        $this->addSql('DROP INDEX IDX_6D76B53157B581A4 ON Guest');
        $this->addSql('ALTER TABLE Guest DROP type_guest_id');
    }
}
