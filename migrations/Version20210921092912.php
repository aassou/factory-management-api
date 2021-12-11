<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921092912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartmenet DROP FOREIGN KEY FK_6BC3E889166D1F9C');
        $this->addSql('DROP INDEX IDX_6BC3E889166D1F9C ON appartmenet');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartmenet ADD CONSTRAINT FK_6BC3E889166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6BC3E889166D1F9C ON appartmenet (project_id)');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME NOT NULL');
    }
}
