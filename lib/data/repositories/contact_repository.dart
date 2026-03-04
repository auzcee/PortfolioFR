// lib/data/repositories/contact_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/contact_model.dart';

class ContactRepository {
  final DatabaseService _db;

  ContactRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(ContactModel contact) async {
    final db = await _db.getDatabase();
    return db.insert(
      'contacts',
      contact.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<List<ContactModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'contacts',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'sort_order ASC',
    );
    return rows.map(ContactModel.fromMap).toList();
  }

  Future<int> update(ContactModel contact) async {
    final db = await _db.getDatabase();
    return db.update(
      'contacts',
      contact.toMap(),
      where: 'id = ?',
      whereArgs: [contact.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('contacts', where: 'id = ?', whereArgs: [id]);
  }
}
