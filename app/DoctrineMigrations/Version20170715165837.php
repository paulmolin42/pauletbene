<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170715165837 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE carpooling_topic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE carpooling_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE carpooling_topic (id INT NOT NULL, posted_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, author VARCHAR(255) NOT NULL, content TEXT NOT NULL, offer_or_request INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE carpooling_message (id INT NOT NULL, carpooling_topic_id INT DEFAULT NULL, postedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, author VARCHAR(255) NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_657F61A17EED1DBF ON carpooling_message (carpooling_topic_id)');
        $this->addSql('ALTER TABLE carpooling_message ADD CONSTRAINT FK_657F61A17EED1DBF FOREIGN KEY (carpooling_topic_id) REFERENCES carpooling_topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE carpooling_message DROP CONSTRAINT FK_657F61A17EED1DBF');
        $this->addSql('DROP SEQUENCE carpooling_topic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE carpooling_message_id_seq CASCADE');
        $this->addSql('DROP TABLE carpooling_topic');
        $this->addSql('DROP TABLE carpooling_message');
    }
}
