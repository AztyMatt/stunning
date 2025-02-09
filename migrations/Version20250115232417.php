<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250115232417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE comment (id SERIAL NOT NULL, author_id INT NOT NULL, project_public_informations_id INT DEFAULT NULL, project_private_informations_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C20AE5150 ON comment (project_public_informations_id)');
        $this->addSql('CREATE INDEX IDX_9474526CC4FA5E53 ON comment (project_private_informations_id)');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "group" (id SERIAL NOT NULL, owner_id INT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6DC044C57E3C61F9 ON "group" (owner_id)');
        $this->addSql('CREATE TABLE invitation (id SERIAL NOT NULL, project_id INT NOT NULL, sender_id INT NOT NULL, message TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F11D61A2166D1F9C ON invitation (project_id)');
        $this->addSql('CREATE INDEX IDX_F11D61A2F624B39D ON invitation (sender_id)');
        $this->addSql('CREATE TABLE invitation_user (invitation_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(invitation_id, user_id))');
        $this->addSql('CREATE INDEX IDX_40921A1DA35D7AF0 ON invitation_user (invitation_id)');
        $this->addSql('CREATE INDEX IDX_40921A1DA76ED395 ON invitation_user (user_id)');
        $this->addSql('CREATE TABLE link (id SERIAL NOT NULL, project_public_informations_id INT DEFAULT NULL, project_private_informations_id INT DEFAULT NULL, name VARCHAR(40) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36AC99F120AE5150 ON link (project_public_informations_id)');
        $this->addSql('CREATE INDEX IDX_36AC99F1C4FA5E53 ON link (project_private_informations_id)');
        $this->addSql('CREATE TABLE media (id SERIAL NOT NULL, project_public_informations_id INT DEFAULT NULL, project_private_informations_id INT DEFAULT NULL, file VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C20AE5150 ON media (project_public_informations_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CC4FA5E53 ON media (project_private_informations_id)');
        $this->addSql('CREATE TABLE project (id SERIAL NOT NULL, collection_id INT DEFAULT NULL, public_informations_id INT DEFAULT NULL, private_informations_id INT DEFAULT NULL, name VARCHAR(40) NOT NULL, visibility VARCHAR(255) NOT NULL, number_of_views INT NOT NULL, likes INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE514956FD ON project (collection_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EEB6E1B683 ON project (public_informations_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EEDBB692DA ON project (private_informations_id)');
        $this->addSql('COMMENT ON COLUMN project.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE project_technology (project_id INT NOT NULL, technology_id INT NOT NULL, PRIMARY KEY(project_id, technology_id))');
        $this->addSql('CREATE INDEX IDX_ECC5297F166D1F9C ON project_technology (project_id)');
        $this->addSql('CREATE INDEX IDX_ECC5297F4235D463 ON project_technology (technology_id)');
        $this->addSql('CREATE TABLE project_tag (project_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(project_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_91F26D60166D1F9C ON project_tag (project_id)');
        $this->addSql('CREATE INDEX IDX_91F26D60BAD26311 ON project_tag (tag_id)');
        $this->addSql('CREATE TABLE project_private_informations (id SERIAL NOT NULL, documentation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project_public_informations (id SERIAL NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE social_medias (id SERIAL NOT NULL, x_twitter VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, figma VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag (id SERIAL NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE technology (id SERIAL NOT NULL, name VARCHAR(30) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, social_medias_id INT DEFAULT NULL, username VARCHAR(15) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) NOT NULL, banner VARCHAR(255) DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5A2FA3C ON "user" (social_medias_id)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_project (user_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(user_id, project_id))');
        $this->addSql('CREATE INDEX IDX_77BECEE4A76ED395 ON user_project (user_id)');
        $this->addSql('CREATE INDEX IDX_77BECEE4166D1F9C ON user_project (project_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C20AE5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC4FA5E53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT FK_6DC044C57E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2F624B39D FOREIGN KEY (sender_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation_user ADD CONSTRAINT FK_40921A1DA35D7AF0 FOREIGN KEY (invitation_id) REFERENCES invitation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation_user ADD CONSTRAINT FK_40921A1DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F120AE5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1C4FA5E53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C20AE5150 FOREIGN KEY (project_public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC4FA5E53 FOREIGN KEY (project_private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE514956FD FOREIGN KEY (collection_id) REFERENCES "group" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB6E1B683 FOREIGN KEY (public_informations_id) REFERENCES project_public_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEDBB692DA FOREIGN KEY (private_informations_id) REFERENCES project_private_informations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_technology ADD CONSTRAINT FK_ECC5297F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_technology ADD CONSTRAINT FK_ECC5297F4235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_91F26D60166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_91F26D60BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649F5A2FA3C FOREIGN KEY (social_medias_id) REFERENCES social_medias (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C20AE5150');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CC4FA5E53');
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT FK_6DC044C57E3C61F9');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2166D1F9C');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2F624B39D');
        $this->addSql('ALTER TABLE invitation_user DROP CONSTRAINT FK_40921A1DA35D7AF0');
        $this->addSql('ALTER TABLE invitation_user DROP CONSTRAINT FK_40921A1DA76ED395');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F120AE5150');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1C4FA5E53');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C20AE5150');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CC4FA5E53');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE514956FD');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EEB6E1B683');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EEDBB692DA');
        $this->addSql('ALTER TABLE project_technology DROP CONSTRAINT FK_ECC5297F166D1F9C');
        $this->addSql('ALTER TABLE project_technology DROP CONSTRAINT FK_ECC5297F4235D463');
        $this->addSql('ALTER TABLE project_tag DROP CONSTRAINT FK_91F26D60166D1F9C');
        $this->addSql('ALTER TABLE project_tag DROP CONSTRAINT FK_91F26D60BAD26311');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649F5A2FA3C');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE4A76ED395');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE4166D1F9C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE invitation_user');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_technology');
        $this->addSql('DROP TABLE project_tag');
        $this->addSql('DROP TABLE project_private_informations');
        $this->addSql('DROP TABLE project_public_informations');
        $this->addSql('DROP TABLE social_medias');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
