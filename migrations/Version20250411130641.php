<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250411130641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, bureau_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_B8EE387232516FE2 (bureau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, organizer_id INT NOT NULL, bureau_id INT DEFAULT NULL, club_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, capacity INT DEFAULT NULL, interest_count INT DEFAULT NULL, INDEX IDX_3BAE0AA7876C4DDA (organizer_id), INDEX IDX_3BAE0AA732516FE2 (bureau_id), INDEX IDX_3BAE0AA761190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, nb_places INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_62A8A7A7A76ED395 (user_id), INDEX IDX_62A8A7A771F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, login VARCHAR(50) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_bureau (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, bureau_id INT NOT NULL, role_in_bureau VARCHAR(50) DEFAULT NULL, INDEX IDX_733DC5F9A76ED395 (user_id), INDEX IDX_733DC5F932516FE2 (bureau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_club (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, club_id INT NOT NULL, role_in_club VARCHAR(50) DEFAULT NULL, INDEX IDX_C26F74BBA76ED395 (user_id), INDEX IDX_C26F74BB61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387232516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7876C4DDA FOREIGN KEY (organizer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA732516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA761190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A771F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE user_bureau ADD CONSTRAINT FK_733DC5F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_bureau ADD CONSTRAINT FK_733DC5F932516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE user_club ADD CONSTRAINT FK_C26F74BBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_club ADD CONSTRAINT FK_C26F74BB61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387232516FE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7876C4DDA');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA732516FE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA761190A32');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7A76ED395');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A771F7E88B');
        $this->addSql('ALTER TABLE user_bureau DROP FOREIGN KEY FK_733DC5F9A76ED395');
        $this->addSql('ALTER TABLE user_bureau DROP FOREIGN KEY FK_733DC5F932516FE2');
        $this->addSql('ALTER TABLE user_club DROP FOREIGN KEY FK_C26F74BBA76ED395');
        $this->addSql('ALTER TABLE user_club DROP FOREIGN KEY FK_C26F74BB61190A32');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_bureau');
        $this->addSql('DROP TABLE user_club');
    }
}
