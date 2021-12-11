<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903081415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, arabic_name VARCHAR(255) NOT NULL, land_title VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, arabic_address VARCHAR(255) NOT NULL, surface VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, budget DOUBLE PRECISION NOT NULL, lot_number VARCHAR(255) NOT NULL, authorization_number VARCHAR(255) NOT NULL, authorization_date DATE NOT NULL, number_floors INT NOT NULL, basement VARCHAR(255) NOT NULL, ground_floor VARCHAR(255) NOT NULL, mezzanin VARCHAR(255) NOT NULL, stairwell_cage VARCHAR(255) NOT NULL, terrace VARCHAR(255) NOT NULL, floor_surface VARCHAR(255) NOT NULL, deadline DATE NOT NULL, price_meter_incl_vat DOUBLE PRECISION NOT NULL, price_meter_excl_vat DOUBLE PRECISION NOT NULL, vat VARCHAR(255) NOT NULL, architect VARCHAR(255) NOT NULL, reinforced_cement VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, closed DATE NOT NULL, created DATE NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATE DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }
}
