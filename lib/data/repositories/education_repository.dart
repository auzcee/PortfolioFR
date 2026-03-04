// lib/data/repositories/education_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/education_model.dart';

class EducationRepository {
  final DatabaseService _db;

  EducationRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(EducationModel education) async {
    final db = await _db.getDatabase();
    return db.insert(
      'education',
      education.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<List<EducationModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'education',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'sort_order ASC, start_date DESC',
    );
    return rows.map(EducationModel.fromMap).toList();
  }

  Future<int> update(EducationModel education) async {
    final db = await _db.getDatabase();
    return db.update(
      'education',
      education.toMap(),
      where: 'id = ?',
      whereArgs: [education.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('education', where: 'id = ?', whereArgs: [id]);
  }
}
