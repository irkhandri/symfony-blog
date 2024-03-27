<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321100826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interest ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE interest ADD CONSTRAINT FK_6C3E1A67CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_6C3E1A67CCFA12B8 ON interest (profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interest DROP FOREIGN KEY FK_6C3E1A67CCFA12B8');
        $this->addSql('DROP INDEX IDX_6C3E1A67CCFA12B8 ON interest');
        $this->addSql('ALTER TABLE interest DROP profile_id');
    }
}
