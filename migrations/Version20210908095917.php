<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210908095917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project CHANGE mezzanin mezzanin NUMERIC(9, 2) NOT NULL, CHANGE stairwell_cage stairwell_cage NUMERIC(9, 2) NOT NULL, CHANGE terrace terrace NUMERIC(9, 2) NOT NULL, CHANGE floor_surface floor_surface NUMERIC(9, 2) NOT NULL, CHANGE deadline deadline INT NOT NULL, CHANGE price_meter_incl_vat price_meter_incl_vat NUMERIC(9, 2) NOT NULL, CHANGE price_meter_excl_vat price_meter_excl_vat NUMERIC(9, 2) NOT NULL, CHANGE vat vat NUMERIC(9, 2) NOT NULL, CHANGE architect architect LONGTEXT NOT NULL, CHANGE reinforced_cement reinforced_cement LONGTEXT NOT NULL, CHANGE status status INT NOT NULL, CHANGE closed closed INT NOT NULL, CHANGE created created DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project CHANGE mezzanin mezzanin DOUBLE PRECISION NOT NULL, CHANGE stairwell_cage stairwell_cage VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE terrace terrace VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE floor_surface floor_surface VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE deadline deadline DATE DEFAULT NULL, CHANGE price_meter_incl_vat price_meter_incl_vat DOUBLE PRECISION NOT NULL, CHANGE price_meter_excl_vat price_meter_excl_vat DOUBLE PRECISION NOT NULL, CHANGE vat vat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE architect architect VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reinforced_cement reinforced_cement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE closed closed DATE DEFAULT NULL, CHANGE created created DATE DEFAULT NULL');
    }
}
