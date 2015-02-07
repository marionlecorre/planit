<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150207190230 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE TypeGuest CHANGE message message TINYTEXT NOT NULL');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_1F1B251E3A4E3DAB');
        $this->addSql('DROP INDEX IDX_1F1B251E3A4E3DAB ON expense');
        $this->addSql('ALTER TABLE expense DROP type_item_id, CHANGE type_expense_id type_expense_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6EE960D5E FOREIGN KEY (type_expense_id) REFERENCES type_expense (id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA6EE960D5E ON expense (type_expense_id)');
        $this->addSql('ALTER TABLE type_expense DROP FOREIGN KEY FK_C814E016AFC2B591');
        $this->addSql('DROP INDEX idx_c814e016afc2b591 ON type_expense');
        $this->addSql('CREATE INDEX IDX_51BE253AFC2B591 ON type_expense (module_id)');
        $this->addSql('ALTER TABLE type_expense ADD CONSTRAINT FK_C814E016AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE TypeGuest CHANGE message message TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA6EE960D5E');
        $this->addSql('DROP INDEX IDX_2D3A8DA6EE960D5E ON expense');
        $this->addSql('ALTER TABLE expense ADD type_item_id INT DEFAULT NULL, CHANGE type_expense_id type_expense_id INT NOT NULL');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_1F1B251E3A4E3DAB FOREIGN KEY (type_item_id) REFERENCES type_expense (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E3A4E3DAB ON expense (type_item_id)');
        $this->addSql('ALTER TABLE type_expense DROP FOREIGN KEY FK_51BE253AFC2B591');
        $this->addSql('DROP INDEX idx_51be253afc2b591 ON type_expense');
        $this->addSql('CREATE INDEX IDX_C814E016AFC2B591 ON type_expense (module_id)');
        $this->addSql('ALTER TABLE type_expense ADD CONSTRAINT FK_51BE253AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }
}
