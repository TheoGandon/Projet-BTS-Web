<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221080847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE refresh_tokens ADD refresh_token VARCHAR(128) NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD valid DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens');
        $this->addSql('ALTER TABLE refresh_tokens DROP refresh_token, DROP username, DROP valid, CHANGE id id VARCHAR(255) NOT NULL');
    }
}
