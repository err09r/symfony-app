<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606114927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA457294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_84BCFA457294869C ON poll (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA457294869C');
        $this->addSql('DROP INDEX IDX_84BCFA457294869C ON poll');
        $this->addSql('ALTER TABLE poll DROP article_id');
    }
}
