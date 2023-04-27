<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427104359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id BLOB NOT NULL --(DC2Type:uuid)
        , artist_id BLOB DEFAULT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_39986E43B7970CF8 ON album (artist_id)');
        $this->addSql('CREATE TABLE album_song (album_id BLOB NOT NULL --(DC2Type:uuid)
        , song_id INTEGER NOT NULL, PRIMARY KEY(album_id, song_id), CONSTRAINT FK_57E658E11137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_57E658E1A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_57E658E11137ABCF ON album_song (album_id)');
        $this->addSql('CREATE INDEX IDX_57E658E1A0BDB2F3 ON album_song (song_id)');
        $this->addSql('CREATE TABLE artist_song (artist_id BLOB NOT NULL --(DC2Type:uuid)
        , song_id INTEGER NOT NULL, PRIMARY KEY(artist_id, song_id), CONSTRAINT FK_8F53683EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8F53683EA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8F53683EB7970CF8 ON artist_song (artist_id)');
        $this->addSql('CREATE INDEX IDX_8F53683EA0BDB2F3 ON artist_song (song_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_song');
        $this->addSql('DROP TABLE artist_song');
    }
}
