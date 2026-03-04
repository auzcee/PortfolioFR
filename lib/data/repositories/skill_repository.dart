// lib/data/repositories/skill_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/skill_model.dart';

class SkillRepository {
  final DatabaseService _db;

  SkillRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(SkillModel skill) async {
    final db = await _db.getDatabase();
    return db.insert(
      'skills',
      skill.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<List<SkillModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'skills',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'sort_order ASC, name ASC',
    );
    return rows.map(SkillModel.fromMap).toList();
  }

  Future<List<SkillModel>> findByCategory(int userId, String category) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'skills',
      where: 'user_id = ? AND category = ?',
      whereArgs: [userId, category],
      orderBy: 'sort_order ASC',
    );
    return rows.map(SkillModel.fromMap).toList();
  }

  Future<int> update(SkillModel skill) async {
    final db = await _db.getDatabase();
    return db.update(
      'skills',
      skill.toMap(),
      where: 'id = ?',
      whereArgs: [skill.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('skills', where: 'id = ?', whereArgs: [id]);
  }
}
