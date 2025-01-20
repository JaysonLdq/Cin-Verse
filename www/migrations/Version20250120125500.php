<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120125500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acting (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, image_path VARCHAR(255) NOT NULL, INDEX IDX_270B0577BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, saison_id INT DEFAULT NULL, label VARCHAR(160) NOT NULL, ordre INT NOT NULL, INDEX IDX_DDAA1CDAF965414C (saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_serie (id INT AUTO_INCREMENT NOT NULL, age_id INT DEFAULT NULL, saison_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, release_date DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, duration INT NOT NULL, language VARCHAR(150) NOT NULL, INDEX IDX_33566D64CC80CD12 (age_id), INDEX IDX_33566D64F965414C (saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_serie_acting (film_serie_id INT NOT NULL, acting_id INT NOT NULL, INDEX IDX_4066FBA27BC447D4 (film_serie_id), INDEX IDX_4066FBA2DD5A960F (acting_id), PRIMARY KEY(film_serie_id, acting_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_serie_genre (film_serie_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_33E42A637BC447D4 (film_serie_id), INDEX IDX_33E42A634296D31F (genre_id), PRIMARY KEY(film_serie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, iuser_id INT DEFAULT NULL, film_serie_id INT DEFAULT NULL, note INT NOT NULL, INDEX IDX_CFBDFA1490846812 (iuser_id), INDEX IDX_CFBDFA147BC447D4 (film_serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acting ADD CONSTRAINT FK_270B0577BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDAF965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE film_serie ADD CONSTRAINT FK_33566D64CC80CD12 FOREIGN KEY (age_id) REFERENCES age (id)');
        $this->addSql('ALTER TABLE film_serie ADD CONSTRAINT FK_33566D64F965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE film_serie_acting ADD CONSTRAINT FK_4066FBA27BC447D4 FOREIGN KEY (film_serie_id) REFERENCES film_serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_serie_acting ADD CONSTRAINT FK_4066FBA2DD5A960F FOREIGN KEY (acting_id) REFERENCES acting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_serie_genre ADD CONSTRAINT FK_33E42A637BC447D4 FOREIGN KEY (film_serie_id) REFERENCES film_serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_serie_genre ADD CONSTRAINT FK_33E42A634296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1490846812 FOREIGN KEY (iuser_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA147BC447D4 FOREIGN KEY (film_serie_id) REFERENCES film_serie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acting DROP FOREIGN KEY FK_270B0577BE04EA9');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDAF965414C');
        $this->addSql('ALTER TABLE film_serie DROP FOREIGN KEY FK_33566D64CC80CD12');
        $this->addSql('ALTER TABLE film_serie DROP FOREIGN KEY FK_33566D64F965414C');
        $this->addSql('ALTER TABLE film_serie_acting DROP FOREIGN KEY FK_4066FBA27BC447D4');
        $this->addSql('ALTER TABLE film_serie_acting DROP FOREIGN KEY FK_4066FBA2DD5A960F');
        $this->addSql('ALTER TABLE film_serie_genre DROP FOREIGN KEY FK_33E42A637BC447D4');
        $this->addSql('ALTER TABLE film_serie_genre DROP FOREIGN KEY FK_33E42A634296D31F');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1490846812');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA147BC447D4');
        $this->addSql('DROP TABLE acting');
        $this->addSql('DROP TABLE age');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE film_serie');
        $this->addSql('DROP TABLE film_serie_acting');
        $this->addSql('DROP TABLE film_serie_genre');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
