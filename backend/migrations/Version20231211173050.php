<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211173050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3EE88CCE5');
        $this->addSql('DROP INDEX IDX_FB090B3EE88CCE5 ON article_picture');
        $this->addSql('ALTER TABLE article_picture CHANGE color_id_id color_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_FB090B3E7ADA1FB5 ON article_picture (color_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3E7ADA1FB5');
        $this->addSql('DROP INDEX IDX_FB090B3E7ADA1FB5 ON article_picture');
        $this->addSql('ALTER TABLE article_picture CHANGE color_id color_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3EE88CCE5 FOREIGN KEY (color_id_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_FB090B3EE88CCE5 ON article_picture (color_id_id)');
    }
}
