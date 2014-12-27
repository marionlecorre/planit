<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141227221101 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_6D76B531AFC2B591');
        $this->addSql('DROP INDEX IDX_6D76B531AFC2B591 ON guest');
        $this->addSql('ALTER TABLE guest DROP module_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Guest ADD module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Guest ADD CONSTRAINT FK_6D76B531AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_6D76B531AFC2B591 ON Guest (module_id)');
    }
}
