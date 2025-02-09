<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202153454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link DROP CONSTRAINT fk_36ac99f120ae5150');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0eeb6e1b683');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c20ae5150');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT fk_6a2ca10c20ae5150');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT fk_36ac99f1c4fa5e53');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0eedbb692da');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cc4fa5e53');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT fk_6a2ca10cc4fa5e53');
        $this->addSql('DROP SEQUENCE project_private_informations_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_public_informations_id_seq CASCADE');
        $this->addSql('CREATE TABLE private_informations (id SERIAL NOT NULL, project_id INT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39EBCC8B166D1F9C ON private_informations (project_id)');
        $this->addSql('CREATE TABLE public_informations (id SERIAL NOT NULL, project_id INT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_48A7BCAC166D1F9C ON public_informations (project_id)');
        $this->addSql('ALTER TABLE private_informations ADD CONSTRAINT FK_39EBCC8B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public_informations ADD CONSTRAINT FK_48A7BCAC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE project_public_informations');
        $this->addSql('DROP TABLE project_private_informations');
        $this->addSql('DROP INDEX idx_9474526cc4fa5e53');
        $this->addSql('DROP INDEX idx_9474526c20ae5150');
        $this->addSql('ALTER TABLE comment ADD public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment DROP project_public_informations_id');
        $this->addSql('ALTER TABLE comment DROP project_private_informations_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526CB6E1B683 ON comment (public_informations_id)');
        $this->addSql('CREATE INDEX IDX_9474526CDBB692DA ON comment (private_informations_id)');
        $this->addSql('DROP INDEX idx_36ac99f1c4fa5e53');
        $this->addSql('DROP INDEX idx_36ac99f120ae5150');
        $this->addSql('ALTER TABLE link ADD public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link DROP project_public_informations_id');
        $this->addSql('ALTER TABLE link DROP project_private_informations_id');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1B6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1DBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_36AC99F1B6E1B683 ON link (public_informations_id)');
        $this->addSql('CREATE INDEX IDX_36AC99F1DBB692DA ON link (private_informations_id)');
        $this->addSql('DROP INDEX idx_6a2ca10cc4fa5e53');
        $this->addSql('DROP INDEX idx_6a2ca10c20ae5150');
        $this->addSql('ALTER TABLE media ADD public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media DROP project_public_informations_id');
        $this->addSql('ALTER TABLE media DROP project_private_informations_id');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB6E1B683 FOREIGN KEY (public_informations_id) REFERENCES public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CDBB692DA FOREIGN KEY (private_informations_id) REFERENCES private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB6E1B683 ON media (public_informations_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CDBB692DA ON media (private_informations_id)');
        $this->addSql('DROP INDEX uniq_2fb3d0eedbb692da');
        $this->addSql('DROP INDEX uniq_2fb3d0eeb6e1b683');
        $this->addSql('ALTER TABLE project DROP public_informations_id');
        $this->addSql('ALTER TABLE project DROP private_informations_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CDBB692DA');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1DBB692DA');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CDBB692DA');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CB6E1B683');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1B6E1B683');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CB6E1B683');
        $this->addSql('CREATE SEQUENCE project_private_informations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_public_informations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE project_public_informations (id SERIAL NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project_private_informations (id SERIAL NOT NULL, documentation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE private_informations DROP CONSTRAINT FK_39EBCC8B166D1F9C');
        $this->addSql('ALTER TABLE public_informations DROP CONSTRAINT FK_48A7BCAC166D1F9C');
        $this->addSql('DROP TABLE private_informations');
        $this->addSql('DROP TABLE public_informations');
        $this->addSql('DROP INDEX IDX_36AC99F1B6E1B683');
        $this->addSql('DROP INDEX IDX_36AC99F1DBB692DA');
        $this->addSql('ALTER TABLE link ADD project_public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD project_private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link DROP public_informations_id');
        $this->addSql('ALTER TABLE link DROP private_informations_id');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT fk_36ac99f120ae5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT fk_36ac99f1c4fa5e53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_36ac99f1c4fa5e53 ON link (project_private_informations_id)');
        $this->addSql('CREATE INDEX idx_36ac99f120ae5150 ON link (project_public_informations_id)');
        $this->addSql('ALTER TABLE project ADD public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0eeb6e1b683 FOREIGN KEY (public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0eedbb692da FOREIGN KEY (private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_2fb3d0eedbb692da ON project (private_informations_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_2fb3d0eeb6e1b683 ON project (public_informations_id)');
        $this->addSql('DROP INDEX IDX_9474526CB6E1B683');
        $this->addSql('DROP INDEX IDX_9474526CDBB692DA');
        $this->addSql('ALTER TABLE comment ADD project_public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD project_private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment DROP public_informations_id');
        $this->addSql('ALTER TABLE comment DROP private_informations_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c20ae5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cc4fa5e53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526cc4fa5e53 ON comment (project_private_informations_id)');
        $this->addSql('CREATE INDEX idx_9474526c20ae5150 ON comment (project_public_informations_id)');
        $this->addSql('DROP INDEX IDX_6A2CA10CB6E1B683');
        $this->addSql('DROP INDEX IDX_6A2CA10CDBB692DA');
        $this->addSql('ALTER TABLE media ADD project_public_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD project_private_informations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media DROP public_informations_id');
        $this->addSql('ALTER TABLE media DROP private_informations_id');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT fk_6a2ca10c20ae5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT fk_6a2ca10cc4fa5e53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6a2ca10cc4fa5e53 ON media (project_private_informations_id)');
        $this->addSql('CREATE INDEX idx_6a2ca10c20ae5150 ON media (project_public_informations_id)');
    }
}
