<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250126004154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0ee514956fd');
        $this->addSql('DROP INDEX idx_2fb3d0ee514956fd');
        $this->addSql('ALTER TABLE project DROP collection_id');
        $this->addSql('ALTER TABLE "user" ADD reset_token UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN "user".reset_token IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP reset_token');
        $this->addSql('ALTER TABLE project ADD collection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0ee514956fd FOREIGN KEY (collection_id) REFERENCES "group" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2fb3d0ee514956fd ON project (collection_id)');
    }
}
