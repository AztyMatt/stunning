<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250201214143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment ALTER author_id DROP NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2F624B39D');
        $this->addSql('ALTER TABLE invitation ALTER project_id DROP NOT NULL');
        $this->addSql('ALTER TABLE invitation ALTER sender_id DROP NOT NULL');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2F624B39D FOREIGN KEY (sender_id) REFERENCES "user" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT fk_f11d61a2f624b39d');
        $this->addSql('ALTER TABLE invitation ALTER project_id SET NOT NULL');
        $this->addSql('ALTER TABLE invitation ALTER sender_id SET NOT NULL');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT fk_f11d61a2f624b39d FOREIGN KEY (sender_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cf675f31b');
        $this->addSql('ALTER TABLE comment ALTER author_id SET NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cf675f31b FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
