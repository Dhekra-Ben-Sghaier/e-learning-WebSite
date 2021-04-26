<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418221429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY id_fk');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY id_user_fk');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984566B3CA4B FOREIGN KEY (id_user) REFERENCES personnes (id_user)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456BF396750 FOREIGN KEY (id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE achat RENAME INDEX id_user_fk TO IDX_26A984566B3CA4B');
        $this->addSql('ALTER TABLE achat RENAME INDEX id_fk TO IDX_26A98456BF396750');
        $this->addSql('ALTER TABLE questionn CHANGE idQuiz idQuiz INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984566B3CA4B');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456BF396750');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT id_fk FOREIGN KEY (id) REFERENCES formation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT id_user_fk FOREIGN KEY (id_user) REFERENCES personnes (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat RENAME INDEX idx_26a98456bf396750 TO id_fk');
        $this->addSql('ALTER TABLE achat RENAME INDEX idx_26a984566b3ca4b TO id_user_fk');
        $this->addSql('ALTER TABLE formation CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE questionn CHANGE idQuiz idQuiz INT NOT NULL');
    }
}
