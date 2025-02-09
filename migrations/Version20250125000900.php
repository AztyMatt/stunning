<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250125000900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE project_group (project_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(project_id, group_id))');
        $this->addSql('CREATE INDEX IDX_7E954D5B166D1F9C ON project_group (project_id)');
        $this->addSql('CREATE INDEX IDX_7E954D5BFE54D947 ON project_group (group_id)');
        $this->addSql('ALTER TABLE project_group ADD CONSTRAINT FK_7E954D5B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_group ADD CONSTRAINT FK_7E954D5BFE54D947 FOREIGN KEY (group_id) REFERENCES "group" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER roles DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project_group DROP CONSTRAINT FK_7E954D5B166D1F9C');
        $this->addSql('ALTER TABLE project_group DROP CONSTRAINT FK_7E954D5BFE54D947');
        $this->addSql('DROP TABLE project_group');
        $this->addSql('ALTER TABLE "user" ALTER roles SET DEFAULT \'["ROLE_USER"]\'');
    }
}
