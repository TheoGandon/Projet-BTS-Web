<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210152556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_articles (client_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_913B01AD19EB6921 (client_id), INDEX IDX_913B01AD1EBAF6CC (articles_id), PRIMARY KEY(client_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_articles ADD CONSTRAINT FK_913B01AD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_articles ADD CONSTRAINT FK_913B01AD1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_articles DROP FOREIGN KEY FK_913B01AD19EB6921');
        $this->addSql('ALTER TABLE client_articles DROP FOREIGN KEY FK_913B01AD1EBAF6CC');
        $this->addSql('DROP TABLE client_articles');
    }
}
