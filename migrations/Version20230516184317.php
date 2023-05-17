<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516184317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(2000) NOT NULL, image VARCHAR(2083) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, annonce_id INT NOT NULL, contenu VARCHAR(2000) NOT NULL, INDEX IDX_5FB6DEC7FB88E14F (utilisateur_id), INDEX IDX_5FB6DEC78805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC78805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE publication_api DROP FOREIGN KEY FK_8E5B34C060BB6FE6');
        $this->addSql('ALTER TABLE tag_music_group DROP FOREIGN KEY FK_168045ED39478561');
        $this->addSql('ALTER TABLE tag_music_group DROP FOREIGN KEY FK_168045EDBAD26311');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D239478561');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2C8B57370');
        $this->addSql('ALTER TABLE user_announcement DROP FOREIGN KEY FK_CD75A51EA76ED395');
        $this->addSql('ALTER TABLE user_announcement DROP FOREIGN KEY FK_CD75A51E913AEA17');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495583C97B2E');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D3B748BE');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02783C97B2E');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027BC285D3D');
        $this->addSql('ALTER TABLE user_music_group DROP FOREIGN KEY FK_A352F698A76ED395');
        $this->addSql('ALTER TABLE user_music_group DROP FOREIGN KEY FK_A352F69839478561');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968739478561');
        $this->addSql('ALTER TABLE leboncoin__announcements DROP FOREIGN KEY FK_50C7FA91F675F31B');
        $this->addSql('ALTER TABLE leboncoin__announcements DROP FOREIGN KEY FK_50C7FA9112469DE2');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE publication_api');
        $this->addSql('DROP TABLE music_group');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE tag_music_group');
        $this->addSql('DROP TABLE concert');
        $this->addSql('DROP TABLE user_announcement');
        $this->addSql('DROP TABLE leboncoin__categories');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE utilisateur_api');
        $this->addSql('DROP TABLE leboncoin__users');
        $this->addSql('DROP TABLE user_music_group');
        $this->addSql('DROP TABLE tests');
        $this->addSql('DROP TABLE concert_hall');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE leboncoin__announcements');
        $this->addSql('DROP TABLE tag');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE publication_api (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, message VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_publication DATETIME NOT NULL, INDEX IDX_8E5B34C060BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE music_group (id INT AUTO_INCREMENT NOT NULL, stage_name VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, picture VARCHAR(2083) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, firstname VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, profile_picture VARCHAR(2083) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tag_music_group (tag_id INT NOT NULL, music_group_id INT NOT NULL, INDEX IDX_168045EDBAD26311 (tag_id), INDEX IDX_168045ED39478561 (music_group_id), PRIMARY KEY(tag_id, music_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE concert (id INT AUTO_INCREMENT NOT NULL, music_group_id INT NOT NULL, concert_hall_id INT NOT NULL, description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, duration DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, place_number_available INT NOT NULL, picture VARCHAR(2083) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D57C02D239478561 (music_group_id), INDEX IDX_D57C02D2C8B57370 (concert_hall_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_announcement (user_id INT NOT NULL, announcement_id INT NOT NULL, INDEX IDX_CD75A51EA76ED395 (user_id), INDEX IDX_CD75A51E913AEA17 (announcement_id), PRIMARY KEY(user_id, announcement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE leboncoin__categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_8194040D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_reservation_id INT NOT NULL, concert_id INT NOT NULL, place_number INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_42C84955D3B748BE (user_reservation_id), INDEX IDX_42C8495583C97B2E (concert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, user_opinon_id INT NOT NULL, concert_id INT NOT NULL, note SMALLINT NOT NULL, comment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_AB02B027BC285D3D (user_opinon_id), INDEX IDX_AB02B02783C97B2E (concert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur_api (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, login VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_2049647CE7927C74 (email), UNIQUE INDEX UNIQ_2049647CAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE leboncoin__users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, firstname VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, lastname VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, tel VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_A0AD4EB1E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_music_group (user_id INT NOT NULL, music_group_id INT NOT NULL, INDEX IDX_A352F698A76ED395 (user_id), INDEX IDX_A352F69839478561 (music_group_id), PRIMARY KEY(user_id, music_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tests (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE concert_hall (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, photos LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', adress VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, music_group_id INT NOT NULL, firstname VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, picture VARCHAR(2083) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_159968739478561 (music_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE leboncoin__announcements (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, author_id INT NOT NULL, name VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, picture VARCHAR(2083) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, description VARCHAR(2083) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, adress VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, city VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, postalcode INT NOT NULL, price INT NOT NULL, INDEX IDX_50C7FA9112469DE2 (category_id), INDEX IDX_50C7FA91F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE publication_api ADD CONSTRAINT FK_8E5B34C060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur_api (id)');
        $this->addSql('ALTER TABLE tag_music_group ADD CONSTRAINT FK_168045ED39478561 FOREIGN KEY (music_group_id) REFERENCES music_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_music_group ADD CONSTRAINT FK_168045EDBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D239478561 FOREIGN KEY (music_group_id) REFERENCES music_group (id)');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2C8B57370 FOREIGN KEY (concert_hall_id) REFERENCES concert_hall (id)');
        $this->addSql('ALTER TABLE user_announcement ADD CONSTRAINT FK_CD75A51EA76ED395 FOREIGN KEY (user_id) REFERENCES leboncoin__users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_announcement ADD CONSTRAINT FK_CD75A51E913AEA17 FOREIGN KEY (announcement_id) REFERENCES leboncoin__announcements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495583C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D3B748BE FOREIGN KEY (user_reservation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02783C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027BC285D3D FOREIGN KEY (user_opinon_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_music_group ADD CONSTRAINT FK_A352F698A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_music_group ADD CONSTRAINT FK_A352F69839478561 FOREIGN KEY (music_group_id) REFERENCES music_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968739478561 FOREIGN KEY (music_group_id) REFERENCES music_group (id)');
        $this->addSql('ALTER TABLE leboncoin__announcements ADD CONSTRAINT FK_50C7FA91F675F31B FOREIGN KEY (author_id) REFERENCES leboncoin__users (id)');
        $this->addSql('ALTER TABLE leboncoin__announcements ADD CONSTRAINT FK_50C7FA9112469DE2 FOREIGN KEY (category_id) REFERENCES leboncoin__categories (id)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7FB88E14F');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78805AB2F');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE utilisateur');
    }
}
