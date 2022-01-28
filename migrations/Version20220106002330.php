<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106002330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE external_order (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_C764E01B9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE external_order_line (id INT AUTO_INCREMENT NOT NULL, external_order_id INT DEFAULT NULL, product_id INT DEFAULT NULL, description LONGTEXT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, negotiable_unit_price NUMERIC(10, 2) NOT NULL, final_totla_price NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_861B01336293DFCB (external_order_id), INDEX IDX_861B01334584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_order (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_F97308312ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_order_line (id INT AUTO_INCREMENT NOT NULL, internal_order_id INT DEFAULT NULL, product_id INT DEFAULT NULL, description LONGTEXT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, negotiable_unit_price NUMERIC(10, 2) NOT NULL, final_totla_price NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_460DF1C9423DE0E0 (internal_order_id), INDEX IDX_460DF1C94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE external_order ADD CONSTRAINT FK_C764E01B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE external_order_line ADD CONSTRAINT FK_861B01336293DFCB FOREIGN KEY (external_order_id) REFERENCES external_order (id)');
        $this->addSql('ALTER TABLE external_order_line ADD CONSTRAINT FK_861B01334584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE internal_order ADD CONSTRAINT FK_F97308312ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE internal_order_line ADD CONSTRAINT FK_460DF1C9423DE0E0 FOREIGN KEY (internal_order_id) REFERENCES internal_order (id)');
        $this->addSql('ALTER TABLE internal_order_line ADD CONSTRAINT FK_460DF1C94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_order_line DROP FOREIGN KEY FK_861B01336293DFCB');
        $this->addSql('ALTER TABLE internal_order_line DROP FOREIGN KEY FK_460DF1C9423DE0E0');
        $this->addSql('DROP TABLE external_order');
        $this->addSql('DROP TABLE external_order_line');
        $this->addSql('DROP TABLE internal_order');
        $this->addSql('DROP TABLE internal_order_line');
    }
}
