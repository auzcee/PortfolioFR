// lib/data/repositories/certification_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/certification_model.dart';

class CertificationRepository {
  final DatabaseService _db;

  CertificationRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(CertificationModel cert) async {
    final db = await _db.getDatabase();
    return db.insert(
      'certifications',
      cert.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<List<CertificationModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'certifications',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'sort_order ASC, issue_date DESC',
    );
    return rows.map(CertificationModel.fromMap).toList();
  }

  Future<int> update(CertificationModel cert) async {
    final db = await _db.getDatabase();
    return db.update(
      'certifications',
      cert.toMap(),
      where: 'id = ?',
      whereArgs: [cert.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('certifications', where: 'id = ?', whereArgs: [id]);
  }
}
