<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121145108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_serie DROP FOREIGN KEY FK_33566D64F965414C');
        $this->addSql('DROP INDEX IDX_33566D64F965414C ON film_serie');
        $this->addSql('ALTER TABLE film_serie DROP saison_id');
        $this->addSql('ALTER TABLE saison ADD film_serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5867BC447D4 FOREIGN KEY (film_serie_id) REFERENCES film_serie (id)');
        $this->addSql('CREATE INDEX IDX_C0D0D5867BC447D4 ON saison (film_serie_id)');
        $this->addSql('ALTER TABLE user DROP profile_picture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5867BC447D4');
        $this->addSql('DROP INDEX IDX_C0D0D5867BC447D4 ON saison');
        $this->addSql('ALTER TABLE saison DROP film_serie_id');
        $this->addSql('ALTER TABLE `user` ADD profile_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE film_serie ADD saison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film_serie ADD CONSTRAINT FK_33566D64F965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('CREATE INDEX IDX_33566D64F965414C ON film_serie (saison_id)');
    }
}
