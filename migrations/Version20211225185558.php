<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225185558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, surface NUMERIC(10, 2) NOT NULL, secondary_surface NUMERIC(10, 2) DEFAULT NULL, land_title VARCHAR(255) NOT NULL, declared_price NUMERIC(10, 2) DEFAULT NULL, advance_on_declared_price NUMERIC(10, 2) DEFAULT NULL, facade VARCHAR(45) NOT NULL, reserved_by_client VARCHAR(255) DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, resale_amount NUMERIC(12, 2) DEFAULT NULL, floor VARCHAR(45) NOT NULL, number_of_rooms VARCHAR(45) NOT NULL, basement VARCHAR(45) NOT NULL, status INT NOT NULL, project_id INT NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nom_arabe VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, adresse_arabe VARCHAR(255) NOT NULL, telephone1 VARCHAR(255) NOT NULL, telephone2 VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(255) NOT NULL, target VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, arabic_name VARCHAR(255) NOT NULL, land_title VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, arabic_address VARCHAR(255) NOT NULL, surface NUMERIC(10, 2) NOT NULL, description LONGTEXT NOT NULL, budget NUMERIC(12, 2) NOT NULL, lot_number VARCHAR(255) NOT NULL, authorization_number VARCHAR(255) NOT NULL, authorization_date DATE NOT NULL, number_floors INT NOT NULL, basement NUMERIC(9, 2) NOT NULL, ground_floor NUMERIC(9, 2) NOT NULL, mezzanin NUMERIC(9, 2) NOT NULL, stairwell_cage NUMERIC(9, 2) NOT NULL, terrace NUMERIC(9, 2) NOT NULL, floor_surface NUMERIC(9, 2) NOT NULL, deadline INT NOT NULL, price_meter_incl_vat NUMERIC(9, 2) NOT NULL, price_meter_excl_vat NUMERIC(9, 2) NOT NULL, vat NUMERIC(9, 2) NOT NULL, architect LONGTEXT NOT NULL, reinforced_cement LONGTEXT NOT NULL, status INT NOT NULL, closed INT NOT NULL, created DATE NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATE DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone1 VARCHAR(255) NOT NULL, telephone2 VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created DATE NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATE DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, profil VARCHAR(30) NOT NULL, status INT DEFAULT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE user');
    }
}
