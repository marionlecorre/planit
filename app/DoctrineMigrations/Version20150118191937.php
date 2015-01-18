<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150118191937 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE PaymentMeans (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, `label` VARCHAR(30) NOT NULL, INDEX IDX_754997FBAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paymentmeans_module (guestsmodule_id INT NOT NULL, paymentmeans_id INT NOT NULL, INDEX IDX_A4BA4E093A6610AA (guestsmodule_id), INDEX IDX_A4BA4E099F63E055 (paymentmeans_id), PRIMARY KEY(guestsmodule_id, paymentmeans_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE PaymentMeans ADD CONSTRAINT FK_754997FBAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE paymentmeans_module ADD CONSTRAINT FK_A4BA4E093A6610AA FOREIGN KEY (guestsmodule_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paymentmeans_module ADD CONSTRAINT FK_A4BA4E099F63E055 FOREIGN KEY (paymentmeans_id) REFERENCES PaymentMeans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Guest ADD paymentmean_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Guest ADD CONSTRAINT FK_6D76B5311594D248 FOREIGN KEY (paymentmean_id) REFERENCES PaymentMeans (id)');
        $this->addSql('CREATE INDEX IDX_6D76B5311594D248 ON Guest (paymentmean_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Guest DROP FOREIGN KEY FK_6D76B5311594D248');
        $this->addSql('ALTER TABLE paymentmeans_module DROP FOREIGN KEY FK_A4BA4E099F63E055');
        $this->addSql('DROP TABLE PaymentMeans');
        $this->addSql('DROP TABLE paymentmeans_module');
        $this->addSql('DROP INDEX IDX_6D76B5311594D248 ON Guest');
        $this->addSql('ALTER TABLE Guest DROP paymentmean_id');
    }
}
