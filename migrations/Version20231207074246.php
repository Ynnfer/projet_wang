<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207074246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dlc ADD detail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dlc ADD CONSTRAINT FK_AD6CAEA7D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD6CAEA7D8D003BB ON dlc (detail_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dlc DROP FOREIGN KEY FK_AD6CAEA7D8D003BB');
        $this->addSql('DROP INDEX UNIQ_AD6CAEA7D8D003BB ON dlc');
        $this->addSql('ALTER TABLE dlc DROP detail_id');
    }
}
