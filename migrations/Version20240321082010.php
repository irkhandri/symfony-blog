<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321082010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        // $this->addSql('CREATE INDEX IDX_C0155143CCFA12B8 ON blog (profile_id)');
        // $this->addSql('ALTER TABLE profile ADD intro VARCHAR(255) DEFAULT NULL, ADD bio VARCHAR(2222) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143CCFA12B8');
        $this->addSql('DROP INDEX IDX_C0155143CCFA12B8 ON blog');
        $this->addSql('ALTER TABLE profile DROP intro, DROP bio');
    }
}
