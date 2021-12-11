<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210908095345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project CHANGE surface surface NUMERIC(10, 2) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE budget budget NUMERIC(12, 2) NOT NULL, CHANGE basement basement NUMERIC(9, 2) NOT NULL, CHANGE ground_floor ground_floor NUMERIC(9, 2) NOT NULL, CHANGE mezzanin mezzanin DOUBLE PRECISION NOT NULL, CHANGE deadline deadline DATE DEFAULT NULL, CHANGE closed closed DATE DEFAULT NULL, CHANGE created created DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project CHANGE surface surface VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE budget budget DOUBLE PRECISION NOT NULL, CHANGE basement basement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ground_floor ground_floor VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mezzanin mezzanin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE deadline deadline DATE NOT NULL, CHANGE closed closed DATE NOT NULL, CHANGE created created DATE NOT NULL');
    }
}
