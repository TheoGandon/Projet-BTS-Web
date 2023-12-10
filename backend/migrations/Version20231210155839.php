<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210155839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_picture (id INT AUTO_INCREMENT NOT NULL, article_id_id INT NOT NULL, color_id_id INT NOT NULL, picture_link VARCHAR(255) NOT NULL, INDEX IDX_FB090B3E8F3EC46 (article_id_id), INDEX IDX_FB090B3EE88CCE5 (color_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, color_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E8F3EC46 FOREIGN KEY (article_id_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3EE88CCE5 FOREIGN KEY (color_id_id) REFERENCES color (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3E8F3EC46');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3EE88CCE5');
        $this->addSql('DROP TABLE article_picture');
        $this->addSql('DROP TABLE color');
    }
}
