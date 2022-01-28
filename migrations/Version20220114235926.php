<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114235926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE length length DOUBLE PRECISION DEFAULT NULL, CHANGE height height DOUBLE PRECISION DEFAULT NULL, CHANGE width width DOUBLE PRECISION DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL, CHANGE purchase_price purchase_price DOUBLE PRECISION DEFAULT NULL, CHANGE sale_price sale_price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE length length NUMERIC(10, 2) DEFAULT NULL, CHANGE height height NUMERIC(10, 2) DEFAULT NULL, CHANGE width width NUMERIC(10, 2) DEFAULT NULL, CHANGE weight weight NUMERIC(10, 2) DEFAULT NULL, CHANGE purchase_price purchase_price NUMERIC(10, 2) DEFAULT NULL, CHANGE sale_price sale_price NUMERIC(10, 2) DEFAULT NULL');
    }
}
