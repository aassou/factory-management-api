<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104230616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_order (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, description LONGTEXT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, negotiable_unit_price NUMERIC(10, 2) NOT NULL, final_totla_price NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_B2D831FD2ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_order_product (company_order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_59128F9B95087855 (company_order_id), INDEX IDX_59128F9B4584665A (product_id), PRIMARY KEY(company_order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_81398E0996901F54 (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, description LONGTEXT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, negotiable_unit_price NUMERIC(10, 2) NOT NULL, final_totla_price NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, INDEX IDX_3B1CE6A39395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order_product (customer_order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_4155DDE5A15A2E17 (customer_order_id), INDEX IDX_4155DDE54584665A (product_id), PRIMARY KEY(customer_order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_9B2A6C7E96901F54 (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_order ADD CONSTRAINT FK_B2D831FD2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE company_order_product ADD CONSTRAINT FK_59128F9B95087855 FOREIGN KEY (company_order_id) REFERENCES company_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_order_product ADD CONSTRAINT FK_59128F9B4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A39395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer_order_product ADD CONSTRAINT FK_4155DDE5A15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_order_product ADD CONSTRAINT FK_4155DDE54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_order_product DROP FOREIGN KEY FK_59128F9B95087855');
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A39395C3F3');
        $this->addSql('ALTER TABLE customer_order_product DROP FOREIGN KEY FK_4155DDE5A15A2E17');
        $this->addSql('ALTER TABLE company_order DROP FOREIGN KEY FK_B2D831FD2ADD6D8C');
        $this->addSql('DROP TABLE company_order');
        $this->addSql('DROP TABLE company_order_product');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE customer_order_product');
        $this->addSql('DROP TABLE supplier');
    }
}
