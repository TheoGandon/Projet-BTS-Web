<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218232030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_stock (article_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_3C8124717294869C (article_id), INDEX IDX_3C812471DCD6110 (stock_id), PRIMARY KEY(article_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, size_id INT NOT NULL, amount INT NOT NULL, INDEX IDX_4B365660498DA827 (size_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE article_stock ADD CONSTRAINT FK_3C8124717294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_stock ADD CONSTRAINT FK_3C812471DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660498DA827 FOREIGN KEY (size_id) REFERENCES sizes (id)');
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D1EBAF6CC');
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D423285E6');
        $this->addSql('DROP TABLE articles_sizes');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689777D11E');
        $this->addSql('DROP INDEX IDX_BFDD31689777D11E ON articles');
        $this->addSql('ALTER TABLE articles DROP category_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_sizes (articles_id INT NOT NULL, sizes_id INT NOT NULL, INDEX IDX_5E7CAF9D1EBAF6CC (articles_id), INDEX IDX_5E7CAF9D423285E6 (sizes_id), PRIMARY KEY(articles_id, sizes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D423285E6 FOREIGN KEY (sizes_id) REFERENCES sizes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE article_stock DROP FOREIGN KEY FK_3C8124717294869C');
        $this->addSql('ALTER TABLE article_stock DROP FOREIGN KEY FK_3C812471DCD6110');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660498DA827');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_stock');
        $this->addSql('DROP TABLE stock');
        $this->addSql('ALTER TABLE articles ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31689777D11E ON articles (category_id_id)');
    }
}
