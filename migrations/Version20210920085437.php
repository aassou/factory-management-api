<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920085437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartmenet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surface NUMERIC(10, 2) NOT NULL, title VARCHAR(255) NOT NULL, price_declare NUMERIC(10, 2) NOT NULL, advancer_price_declare NUMERIC(10, 2) NOT NULL, surface2 NUMERIC(10, 2) NOT NULL, facade VARCHAR(45) NOT NULL, price NUMERIC(10, 2) NOT NULL, montant_revente NUMERIC(12, 2) NOT NULL, level VARCHAR(45) NOT NULL, number_piece VARCHAR(45) NOT NULL, cellar VARCHAR(45) NOT NULL, status INT NOT NULL, project_id INT NOT NULL, created_by VARCHAR(255) NOT NULL, created DATE NOT NULL, updated DATE DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appartmenet');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }
}
