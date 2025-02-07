<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250207000924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT fk_6dc044c57e3c61f9');
        $this->addSql('DROP INDEX idx_6dc044c57e3c61f9');
        $this->addSql('ALTER TABLE "group" RENAME COLUMN owner_id TO user_id');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT FK_6DC044C5A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6DC044C5A76ED395 ON "group" (user_id)');
        $this->addSql('ALTER TABLE technology ADD has_brand_logo BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE technology DROP logo');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE technology ADD logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE technology DROP has_brand_logo');
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT FK_6DC044C5A76ED395');
        $this->addSql('DROP INDEX IDX_6DC044C5A76ED395');
        $this->addSql('ALTER TABLE "group" RENAME COLUMN user_id TO owner_id');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT fk_6dc044c57e3c61f9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6dc044c57e3c61f9 ON "group" (owner_id)');
    }
}
