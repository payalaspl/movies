<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708111207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('ALTER TABLE state RENAME INDEX idx_6252fdfff92f3e70 TO IDX_A393D2FBF92F3E70');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_2da17977e7927c74 TO UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_2da17977f92f3e70 TO IDX_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_2da179775d83cc1 TO IDX_8D93D6495D83CC1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, logged_at DATETIME NOT NULL, object_id VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, object_class VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, version INT NOT NULL, data LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX log_class_lookup_idx (object_class), INDEX log_user_lookup_idx (username), INDEX log_date_lookup_idx (logged_at), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE state RENAME INDEX idx_a393d2fbf92f3e70 TO IDX_6252FDFFF92F3E70');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d649f92f3e70 TO IDX_2DA17977F92F3E70');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649e7927c74 TO UNIQ_2DA17977E7927C74');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d6495d83cc1 TO IDX_2DA179775D83CC1');
    }
}
