<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701101136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D8A48BBD');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DD71A5B');
        $this->addSql('DROP INDEX IDX_8D93D649DD71A5B ON user');
        $this->addSql('DROP INDEX IDX_8D93D649D8A48BBD ON user');
        $this->addSql('ALTER TABLE user DROP country_id_id, DROP state_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD country_id_id INT DEFAULT NULL, ADD state_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DD71A5B FOREIGN KEY (state_id_id) REFERENCES state (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DD71A5B ON user (state_id_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D8A48BBD ON user (country_id_id)');
    }
}
