<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250208003858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CB6E1B683');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CDBB692DA');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1B6E1B683');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1DBB692DA');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1B6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1DBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CB6E1B683');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CDBB692DA');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CDBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE technology ADD logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE technology DROP has_brand_logo');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE technology ADD has_brand_logo BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE technology DROP logo');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cb6e1b683');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cdbb692da');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cb6e1b683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cdbb692da FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT fk_36ac99f1b6e1b683');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT fk_36ac99f1dbb692da');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT fk_36ac99f1b6e1b683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT fk_36ac99f1dbb692da FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT fk_6a2ca10cb6e1b683');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT fk_6a2ca10cdbb692da');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT fk_6a2ca10cb6e1b683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT fk_6a2ca10cdbb692da FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
