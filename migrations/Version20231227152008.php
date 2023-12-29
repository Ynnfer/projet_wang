<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231227152008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail ADD dlc_id INT DEFAULT NULL, DROP release_date, DROP positive_rating');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93CEF6326C FOREIGN KEY (dlc_id) REFERENCES dlc (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E067F93CEF6326C ON detail (dlc_id)');
        $this->addSql('ALTER TABLE dlc DROP status');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93CEF6326C');
        $this->addSql('DROP INDEX UNIQ_2E067F93CEF6326C ON detail');
        $this->addSql('ALTER TABLE detail ADD release_date VARCHAR(255) NOT NULL, ADD positive_rating VARCHAR(255) NOT NULL, DROP dlc_id');
        $this->addSql('ALTER TABLE dlc ADD status VARCHAR(255) DEFAULT NULL');
    }
}
