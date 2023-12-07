<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207073504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E067F93E48FD905 ON detail (game_id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CD8D003BB');
        $this->addSql('DROP INDEX UNIQ_232B318CD8D003BB ON game');
        $this->addSql('ALTER TABLE game DROP detail_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93E48FD905');
        $this->addSql('DROP INDEX UNIQ_2E067F93E48FD905 ON detail');
        $this->addSql('ALTER TABLE detail DROP game_id');
        $this->addSql('ALTER TABLE game ADD detail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CD8D003BB ON game (detail_id)');
    }
}
