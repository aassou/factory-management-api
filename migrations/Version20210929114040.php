<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929114040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartmenet CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE price_declare price_declare NUMERIC(10, 2) DEFAULT NULL, CHANGE advancer_price_declare advancer_price_declare NUMERIC(10, 2) DEFAULT NULL, CHANGE surface2 surface2 NUMERIC(10, 2) DEFAULT NULL, CHANGE montant_revente montant_revente NUMERIC(12, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartmenet CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price_declare price_declare NUMERIC(10, 2) NOT NULL, CHANGE advancer_price_declare advancer_price_declare NUMERIC(10, 2) NOT NULL, CHANGE surface2 surface2 NUMERIC(10, 2) NOT NULL, CHANGE montant_revente montant_revente NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }
}
